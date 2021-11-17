<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

/**
 * App\Models\User
 *
 * @property int $id
 * @property int $empresa
 * @property int|null $parceiro Parceiro que neste momento esta exibindo os dados, pode ser atualizado durante a sessão
 * @property int|null $facebook_id
 * @property int|null $parceiro_padrao Parceiro padrão ao qual efetivamente pertence o usuario (não muda durante as sessões)
 * @property int|null $parceiro_filho
 * @property string $nome
 * @property string|null $email
 * @property string|null $senha
 * @property string $foto
 * @property string|null $telefone
 * @property string|null $celular
 * @property string|null $dashboard_padrao
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $remember_token
 * @property string $visualiza_todos_contatos
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserGroups[] $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Partner|null $parent
 * @property-read \App\Models\Partner|null $partner
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCelular($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDashboardPadrao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmpresa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFacebookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereParceiro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereParceiroFilho($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereParceiroPadrao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSenha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereTelefone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereVisualizaTodosContatos($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * Table used by this model
     *
     * @var string
     */
    protected $table = 'alc_usuarios';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'empresa',
        'parceiro',
        'facebook_id',
        'parceiro_padrao',
        'parceiro_filho',
        'nome',
        'email',
        'senha',
        'foto',
        'telefone',
        'celular',
        'dashboard_padrao',
        'remember_token',
        'visualiza_todos_contatos',
        'code',
        'send_code_time',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'senha',
        'remember_token',
    ];

    /**
     * Encrypt the password default
     *
     * @param string $value
     * @return void
     */
    public function setSenhaAttribute(string $value): void
    {
        $this->attributes['senha'] = Hash::make($value);
    }

    /**
     * Return a image in base64
     *
     * @return string
     */
    public function getFotoAttribute($value)
    {
        if(is_null($value)) return null;

        return strpos($value, 'base64') === false
            ? 'data:image;base64,' . base64_encode($value)
            : $value;
    }

    /**
     * Return partner from user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class, 'parceiro', 'id');
    }

    /**
     * Return parent from user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function parent()
    {
        return $this->belongsTo(Partner::class, 'parceiro_padrao', 'id');
    }

    public function groups() {
        return $this->hasMany(UserGroups::class,  'usuario', 'id');
    }
}
