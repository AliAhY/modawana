<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // العلاقة مع نموذج Profile  
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // في نموذج Profile
    public function friends()
    {
        return $this->belongsToMany(Profile::class, 'friends', 'profile_id', 'friend_profile_id');
    }


    // علاقة الأصدقاء الذين أضافوه (الأصدقاء الذين يمتلكهم)
    public function friendOf(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id');
    }

    // علاقة لاسترجاع كل الأصدقاء (لكل من الأصدقاء الذين أضافهم والذي أضيفوا كأصدقاء)
    public function allFriends(): Collection
    {
        return $this->friends->merge($this->friendOf);
    }

    // إضافة صديق
    public function addFriend(User $user): void
    {
        if (!$this->isFriendsWith($user)) {
            $this->friends()->create(['friend_id' => $user->id]);
        }
    }

    // إزالة صديق
    public function removeFriend(User $user): void
    {
        if ($this->isFriendsWith($user)) {
            $this->friends()->where('friend_id', $user->id)->delete();
        }
    }

    // التحقق مما إذا كنت صديقًا
    public function isFriendsWith(User $user): bool
    {
        return $this->friends()->where('friend_id', $user->id)->exists();
    }
}
