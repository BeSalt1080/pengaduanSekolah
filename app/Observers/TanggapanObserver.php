<?php

namespace App\Observers;

use App\Models\Tanggapan;

class TanggapanObserver
{
    /**
     * Handle the Tanggapan "created" event.
     */
    public function created(Tanggapan $tanggapan): void
    {
        $tanggapanCount = $tanggapan->aspirasi->tanggapan()->count();
        if ($tanggapanCount == 1) {
            $tanggapan->aspirasi->status = 'Proses';
            dd($tanggapan->aspirasi->save());
        } elseif ($tanggapanCount >= 2) {
            $tanggapan->aspirasi->status = 'Selesai';
            $tanggapan->aspirasi->save();
        }
    }
    /**
     * Handle the Tanggapan "updated" event.
     */
    public function updated(Tanggapan $tanggapan): void
    {
        $this->created($tanggapan); // Same logic for update as for creation
    }

    /**
     * Handle the Tanggapan "deleted" event.
     */
    public function deleted(Tanggapan $tanggapan): void
    {
        $tanggapanCount = $tanggapan->aspirasi->tanggapan()->count();
        if ($tanggapanCount == 0) {
            $tanggapan->aspirasi->status = "Menunggu";
            $tanggapan->aspirasi->save();
        } elseif ($tanggapanCount == 1) {
            $tanggapan->aspirasi->status = 'Proses';
            $tanggapan->aspirasi->save();
        }
    }

    /**
     * Handle the Tanggapan "restored" event.
     */
    public function restored(Tanggapan $tanggapan): void
    {
        //
    }

    /**
     * Handle the Tanggapan "force deleted" event.
     */
    public function forceDeleted(Tanggapan $tanggapan): void
    {
        //
    }
}
