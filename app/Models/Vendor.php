<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Vendor extends Eloquent
{
    public $id;
    public $district ;
    public $metering_system ;
    public $phoneNumber ;
    public $region;
    public $regionid ;
    public $districtid ;
    public $CMSID ;
    public $vendorId ;
    public $vendorName ;
    public $vendorStatus ;

    public function __construct(array $attributes = [])
    {

        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
