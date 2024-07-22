<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:import-outage-file')->everySixHours();