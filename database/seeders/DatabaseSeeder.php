<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\ExamType;
use App\Models\FeeType;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin EMIS',
            'email' => 'admin@emis.local',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
            'phone' => '9800000000',
        ]);

        // Create sample classes
        $classNames = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten'];
        foreach ($classNames as $i => $name) {
            Classes::create([
                'name' => 'Class ' . $name,
                'numeric_name' => $i + 1,
                'section' => 'A',
                'description' => 'Class ' . $name . ' section A',
            ]);
        }

        // Create sample subjects
        $subjects = ['Mathematics', 'English', 'Nepali', 'Science', 'Social Studies', 'Computer', 'Health & PE', 'Moral Education'];
        foreach ($subjects as $i => $subject) {
            Subject::create([
                'name' => $subject,
                'code' => 'SUB-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'class_id' => ($i % 10) + 1,
                'description' => $subject . ' subject',
            ]);
        }

        // Create exam types
        $examTypes = ['First Term', 'Second Term', 'Third Term', 'Final Exam', 'Mid-Term', 'Pre-Board'];
        foreach ($examTypes as $examType) {
            ExamType::create([
                'name' => $examType,
                'description' => $examType . ' examination',
            ]);
        }

        // Create fee types
        $feeTypes = [
            ['name' => 'Tuition Fee', 'amount' => 5000],
            ['name' => 'Admission Fee', 'amount' => 2000],
            ['name' => 'Exam Fee', 'amount' => 1000],
            ['name' => 'Library Fee', 'amount' => 500],
            ['name' => 'Sports Fee', 'amount' => 300],
            ['name' => 'Transport Fee', 'amount' => 1500],
        ];
        foreach ($feeTypes as $feeType) {
            FeeType::create($feeType);
        }
    }
}