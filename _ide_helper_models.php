<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models\Admin{
/**
 * App\Models\Admin\User
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property int $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Brand
 *
 * @property int $id
 * @property string $name
 * @property string|null $image_name
 * @property int|null $is_popular
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereImageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereIsPopular($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereName($value)
 */
	class Brand extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CarExtra
 *
 * @property int $id
 * @property string $extra
 * @property int $extra_category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Offer[] $extras
 * @property-read int|null $extras_count
 * @method static \Illuminate\Database\Eloquent\Builder|CarExtra newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarExtra newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarExtra query()
 * @method static \Illuminate\Database\Eloquent\Builder|CarExtra whereExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarExtra whereExtraCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarExtra whereId($value)
 * @mixin \Eloquent
 */
	class CarExtra extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\City
 *
 * @property int $id
 * @property string $city
 * @property int $region_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $asCity
 * @method static \Illuminate\Database\Eloquent\Builder|City whereAsCity($value)
 * @property int|null $as_city
 */
	class City extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EmailVerification
 *
 * @property int $id
 * @property int $code
 * @property string $expires_at
 * @property int $is_confirmed
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification query()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification whereIsConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification whereUserId($value)
 * @mixin \Eloquent
 * @property int $is_used
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification whereIsUsed($value)
 */
	class EmailVerification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Image
 *
 * @property int $id
 * @property string $image
 * @property int $is_main
 * @property int $offer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereIsMain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Offer $offer
 */
	class Image extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Merchant
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $address
 * @property string $eik
 * @property string|null $domain
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereEik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereUserId($value)
 * @mixin \Eloquent
 */
	class Merchant extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Message
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $receiver_id
 * @property int $sender_id
 * @property string $message
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereReceiverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Message extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Offer
 *
 * @property int $id
 * @property string $title
 * @property float $price
 * @property int $km
 * @property int $year
 * @property int $year_acquired
 * @property int $car_brands_id
 * @property int $car_models_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $description
 * @property int $is_new
 * @property int $fuel
 * @property int $cm3
 * @property int $hp
 * @property int $transmission
 * @property int $color
 * @property int $coupe_type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CarExtra[] $asd
 * @property-read int|null $asd_count
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCarBrandsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCarModelsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCm3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCoupeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereFuel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereIsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereKm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereTransmission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereYearAcquired($value)
 * @mixin \Eloquent
 * @property int $user_id
 * @property int $is_approved
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Offer approved()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer notApproved()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereIsApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereUserId($value)
 * @property-read \App\Models\TopOffer|null $topOffers
 * @property-read \App\Models\VipOffer|null $vipOffers
 * @property int $city_id
 * @property string $condition
 * @property int|null $has_price
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereHasPrice($value)
 */
	class Offer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OfferExtras
 *
 * @property int $id
 * @property int $vehicle_offer_id
 * @property int $extra_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OfferExtras newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferExtras newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferExtras query()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferExtras whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferExtras whereExtraId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferExtras whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferExtras whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferExtras whereVehicleOfferId($value)
 * @mixin \Eloquent
 */
	class OfferExtras extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PasswordReset
 *
 * @property string $email
 * @property int $token
 * @property string $created_at
 * @property string $expires_at
 * @property int $id
 * @property int $code
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset query()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereToken($value)
 * @mixin \Eloquent
 */
	class PasswordReset extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Region
 *
 * @property int $id
 * @property string $region
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region query()
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $is_popular
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereIsPopular($value)
 */
	class Region extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TopOffer
 *
 * @property int $id
 * @property int $offer_id
 * @property string $date_start
 * @property string $date_end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Offer[] $offer
 * @property-read int|null $offer_count
 * @method static \Illuminate\Database\Eloquent\Builder|TopOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TopOffer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TopOffer query()
 * @method static \Illuminate\Database\Eloquent\Builder|TopOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TopOffer whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TopOffer whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TopOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TopOffer whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TopOffer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class TopOffer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $mobile
 * @property int $is_business
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsBusiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $ip
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Offer[] $offers
 * @property-read int|null $offers_count
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIp($value)
 * @property-read \App\Models\Merchant|null $merchant
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messages
 * @property-read int|null $messages_count
 * @property string|null $image_path
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImagePath($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VehicleCategory
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCategory whereName($value)
 */
	class VehicleCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VehicleModel
 *
 * @property-read \App\Models\Brand|null $brands
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel query()
 */
	class VehicleModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VehicleType
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleType query()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleType whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleType whereName($value)
 */
	class VehicleType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VipOffer
 *
 * @property int $id
 * @property int $offer_id
 * @property string $date_start
 * @property string $date_end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Offer[] $offer
 * @property-read int|null $offer_count
 * @method static \Illuminate\Database\Eloquent\Builder|VipOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VipOffer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VipOffer query()
 * @method static \Illuminate\Database\Eloquent\Builder|VipOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VipOffer whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VipOffer whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VipOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VipOffer whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VipOffer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class VipOffer extends \Eloquent {}
}

