<?php
use App\Models\Keuangan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KeuanganExport implements FromCollection, WithHeadings, WithMapping {
    public function collection() {
        return Keuangan::with('bank')->get(); // Sesuaikan model
    }
    
    public function headings(): array {
        return ['ID', 'Jumlah', 'Deskripsi', 'Bank', 'Status', 'Tanggal'];
    }
    
    public function map($keuangan): array {
        return [
            $keuangan->id,
            $keuangan->jumlah,
            $keuangan->deskripsi,
            $keuangan->bank->nama ?? '',
            $keuangan->status,
            $keuangan->tanggal->format('d/m/Y'),
        ];
    }
}
