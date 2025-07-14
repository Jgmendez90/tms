<?php

namespace App\Models\Customers;

use App\Models\Contact;
use App\Models\Facility;
use App\Models\Location;
use App\Traits\HasAliases;
use App\Traits\HasContacts;
use App\Traits\HasDocuments;
use App\Traits\HasOrganization;
use App\Traits\HasNotes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;

class Customer extends Model implements Auditable
{
    use HasFactory, HasOrganization, Searchable, HasNotes, HasContacts, HasDocuments, HasAliases;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'organization_id',
        'name',
        'net_pay_days',
        'billing_location_id',
        'dba_name',
        'invoice_number_schema',
        'billing_contact_id',
    ];

    protected $appends = [ 'selectable_label' ];

    public $aliasName = 'customer';
    public $aliasProperties = [
        'name' => 'name',
    ];

    public function getSelectableLabelAttribute() : string
    {
        return sprintf("%s", $this->name);
    }

    /**
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Facility, $this>
     */

    public function facilities(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        /** Ignoring due to issue with pivot table returns not being supported by Larastan */
        return $this->belongsToMany(Facility::class, 'customer_facilities');
    }

    public function receivables(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(\App\Models\Accounting\Receivable::class, 'payer');
    }

    /**
     * Get the billing location for the customer.
     */
    public function billingLocation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Location::class, 'billing_location_id', 'id');
    }

    /**
     * Get the billing contact for the customer.
     */
    public function billingContact(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Contact::class, 'billing_contact_id', 'id');
    }
}
