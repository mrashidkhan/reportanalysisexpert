<?php

// ========================================
// MODEL
// app/Models/MedicalReport.php
// ========================================

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',  
        'patient_name',
        'phone_number',
        'email',
        'age',
        'report_type',
        'file_paths',
        'symptoms',
        'medical_history',
        'urgency_level',
        'terms_accepted',
        'status',
        'analysis_result',
        'analyzed_at',
        'analyzed_by',
        'price',
        'payment_status'
    ];

    protected $casts = [
        'file_paths' => 'array',
        'terms_accepted' => 'boolean',
        'analyzed_at' => 'datetime',
        'price' => 'decimal:2'
    ];

    protected $dates = [
        'analyzed_at'
    ];

    // Relationships
    public function analyzer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'analyzed_by');
    }

    // Accessors & Mutators
    public function getReportTypeNameAttribute(): string
    {
        $types = [
            'blood_report' => 'Blood Report',
            'xray' => 'X-Ray',
            'mri' => 'MRI Scan',
            'ultrasound' => 'Ultrasound',
            'ct_scan' => 'CT Scan',
            'other' => 'Other'
        ];

        return $types[$this->report_type] ?? 'Unknown';
    }

    public function getUrgencyLevelNameAttribute(): string
    {
        $levels = [
            'normal' => 'Normal Priority',
            'urgent' => 'Urgent',
            'emergency' => 'Emergency'
        ];

        return $levels[$this->urgency_level] ?? 'Normal';
    }

    public function getStatusNameAttribute(): string
    {
        $statuses = [
            'pending' => 'Pending Review',
            'analyzing' => 'Under Analysis',
            'completed' => 'Analysis Complete',
            'cancelled' => 'Cancelled'
        ];

        return $statuses[$this->status] ?? 'Unknown';
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeUrgent($query)
    {
        return $query->whereIn('urgency_level', ['urgent', 'emergency']);
    }

    public function scopeByReportType($query, $type)
    {
        return $query->where('report_type', $type);
    }

    // Helper Methods
    public function calculatePrice(): float
    {
        $basePrices = [
            'blood_report' => 1500,
            'xray' => 2000,
            'mri' => 3500,
            'ultrasound' => 2500,
            'ct_scan' => 3000,
            'other' => 2000
        ];

        $basePrice = $basePrices[$this->report_type] ?? 2000;

        // Apply urgency multipliers
        $multipliers = [
            'normal' => 1.0,
            'urgent' => 1.5,
            'emergency' => 2.0
        ];

        return $basePrice * ($multipliers[$this->urgency_level] ?? 1.0);
    }

    public function getFileCount(): int
    {
        return count($this->file_paths ?? []);
    }

    public function getTotalFileSize(): string
    {
        $totalSize = 0;
        foreach ($this->file_paths ?? [] as $filePath) {
            if (Storage::exists($filePath)) {
                $totalSize += Storage::size($filePath);
            }
        }

        return $this->formatBytes($totalSize);
    }

    private function formatBytes($bytes, $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }

    public function user()
{
    return $this->belongsTo(User::class);
}
}
