<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    public function extras(): BelongsToMany
    {
        return $this->belongsToMany(AdditionalFeatures::class, 'order_extras');
    }

    protected $fillable = [
        'user_id', 'title',
        'service_type_id', 'academic_level_id',
        'subject_id', 'instructions',
        'deadline', 'pages', 'slides',
        'sources', 'spacing_id', 'referencing_style_id',
        'language_id', 'writer_category_id', 'amount',
        'currency_id', 'cpp', 'discount_id',
        'paid', 'discounted', 'due_at',
        'referral_website', 'status', 'review', 'rating',
        'revision_instructions', 'assigned_to','files', 'assigned_to', 'writer_deadline'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rate(): BelongsTo
    {
        return $this->belongsTo(Rate::class);
    }

    public function academicLevel(): BelongsTo
    {
        return $this->belongsTo(AcademicLevel::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function serviceType(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function writerCategory(): BelongsTo
    {
        return $this->belongsTo(WriterCategory::class);
    }

    public function referencingStyle(): BelongsTo
    {
        return $this->belongsTo(ReferencingStyle::class);
    }

    public function spacing(): BelongsTo
    {
        return $this->belongsTo(Spacing::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }
}
