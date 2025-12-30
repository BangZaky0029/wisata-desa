<?php

// ===========================================
// FILE: app/Helpers/custom_helper.php
// Custom Helper Functions
// ===========================================

if (!function_exists('formatRupiah')) {
    /**
     * Format number to Rupiah currency
     */
    function formatRupiah($number)
    {
        return 'Rp ' . number_format($number, 0, ',', '.');
    }
}

if (!function_exists('formatTanggal')) {
    /**
     * Format date to Indonesian format
     */
    function formatTanggal($date, $withTime = false)
    {
        $bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $timestamp = strtotime($date);
        $day = date('d', $timestamp);
        $month = $bulan[(int)date('m', $timestamp)];
        $year = date('Y', $timestamp);

        $result = $day . ' ' . $month . ' ' . $year;

        if ($withTime) {
            $result .= ' ' . date('H:i', $timestamp) . ' WIB';
        }

        return $result;
    }
}

if (!function_exists('timeAgo')) {
    /**
     * Convert datetime to time ago format
     */
    function timeAgo($datetime)
    {
        $timestamp = strtotime($datetime);
        $difference = time() - $timestamp;

        $periods = [
            'detik' => 1,
            'menit' => 60,
            'jam' => 3600,
            'hari' => 86400,
            'minggu' => 604800,
            'bulan' => 2592000,
            'tahun' => 31536000
        ];

        foreach (array_reverse($periods) as $unit => $value) {
            if ($difference >= $value) {
                $time = floor($difference / $value);
                return $time . ' ' . $unit . ' yang lalu';
            }
        }

        return 'Baru saja';
    }
}

if (!function_exists('generateSlug')) {
    /**
     * Generate URL-friendly slug
     */
    function generateSlug($text)
    {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
        $text = preg_replace('/[\s-]+/', ' ', $text);
        $text = trim($text);
        $text = preg_replace('/\s/', '-', $text);
        return $text;
    }
}

if (!function_exists('uploadImage')) {
    /**
     * Handle image upload
     */
    function uploadImage($file, $folder = 'uploads')
    {
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . '../public/' . $folder, $newName);
            return $newName;
        }
        return null;
    }
}

if (!function_exists('deleteImage')) {
    /**
     * Delete image from folder
     */
    function deleteImage($filename, $folder = 'uploads')
    {
        $path = WRITEPATH . '../public/' . $folder . '/' . $filename;
        if (file_exists($path)) {
            unlink($path);
            return true;
        }
        return false;
    }
}

if (!function_exists('truncateText')) {
    /**
     * Truncate text with limit
     */
    function truncateText($text, $limit = 100, $ending = '...')
    {
        if (strlen($text) > $limit) {
            return substr($text, 0, $limit) . $ending;
        }
        return $text;
    }
}

if (!function_exists('getYoutubeId')) {
    /**
     * Extract YouTube video ID from URL
     */
    function getYoutubeId($url)
    {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $match);
        return $match[1] ?? null;
    }
}
