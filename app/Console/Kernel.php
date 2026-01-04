<?php

protected function schedule(Schedule $schedule): void
{
    $schedule->command('trashding:fetch')->hourly();
}
