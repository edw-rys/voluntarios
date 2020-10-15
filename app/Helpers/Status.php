<?php

if (! function_exists('status')) {
    /**
     * Build status badge or button
     *
     * @param $code
     * @param string $type
     * @param string $size
     * @param string $color
     * @return string
     */
    function status($code = 'active', string $type = 'badge', string $size = 'xs', string $color = ''): string
    {
        $elementInit    = '<span class="';
        $elementFinish  = '</span>';

        // SettingType
        if ($type === 'badge') {
            $type = 'badge';
            $size = '';
        } elseif ($type === 'button') {
            $type = 'btn';
            $size = ' btn-' . $size;
        } else {
            $type = '';
            $size = '';
        }

        // Title
        if ($code === 0 || $code === 1) {
            $title  = statusBoolean()[$code];
        } elseif (array_key_exists($code, allStatuses())) {
            $title  = allStatuses()[$code];
        } elseif (in_array($code, allStatuses(), false)) {
            $title  = allStatuses()[$code];
        } else {
            $title  = '';
        }

        // Status
        $status = getStatusByString($code);

        // Color
        if ($color === '') {
            $color = ' ' . $type . '-' . $status->color;
        }

        return $elementInit . $type . $color . $size . '">' . $status->icon . ' ' . $title . $elementFinish;
    }
}

if (! function_exists('')) {
    function getStatusByString($code)
    {
        // ACTIVE
        if ($code === 'active' || $code === 1) {
            $color  = 'success';
            $icon   = '<i class="ik ik-check fa-xs"></i>';
        }
        // INACTIVE
        elseif ($code === 'inactive' || $code === 0) {
            $color  = 'primary';
            $icon   = '<i class="ik ik-alert-triangle fa-xs"></i>';
        }
        // DELETED
        elseif ($code === 'deleted') {
            $color  = 'danger';
            $icon   = '<i class="ik ik-x fa-xs"></i>';
        }
        // BLOCKED
        elseif ($code === 'blocked') {
            $color  = 'warning';
            $icon   = '<i class="ik ik-lock fa-xs"></i>';
        }
        // CREATED
        elseif ($code === 'created') {
            $color  = 'light';
            $icon   = '<i class="ik ik-save fa-xs"></i>';
        }
        // SAVED
        elseif ($code === 'saved') {
            $color  = 'success';
            $icon   = '';
        }
        // PROCESSED
        elseif ($code === 'processed' || $code === 'paid') {
            $color  = 'dark';
            $icon   = '<i class="ik ik-check-circle fa-xs"></i>';
        }
        // UNPROCESSED
        elseif ($code === 'unprocessed' || $code === 'pending_payment' || $code === 'back' || $code === 'received' || $code === 'canceled_sri') {
            $color  = 'warning';
            $icon   = '<i class="ik ik-x-square fa-xs"></i>';
        } else {
            $color  = 'default';
            $icon   = '';
        }
        if ($code === 'finished') {
            $color  = 'warning';
            $icon   = '';
        }

        return (object) [
            'color' => $color,
            'icon'  => $icon,
        ];
    }
}

if (! function_exists('checkForInactiveText')) {
    /**
     * Get all statuses
     *
     * @param string $status
     * @return string
     */
    function checkForInactiveText(string $status): string
    {
        if (! in_array($status, [0, 'deleted', 'inactive', 'blocked'], true)) {
            return '';
        }

        return 'inactive-item';
    }
}

if (! function_exists('allStatuses')) {
    /**
     * Get all statuses
     *
     * @return array
     */
    function allStatuses(): array
    {
        $status = [
            '-'                 => 'N/A',
            1                   => trans('global.yes'),
            0                   => trans('global.no'),
            'active'            => trans('global.status-label.active'),
            'blocked'           => trans('global.status-label.blocked'),
            'inactive'          => trans('global.status-label.inactive'),
            'saved'             => trans('global.status-label.saved'),
            'deleted'           => trans('global.status-label.deleted'),
            'created'           => trans('global.status-label.created'),
            'processed'         => trans('global.status-label.processed'),
            'unprocessed'       => trans('global.status-label.unprocessed'),
            'pending_payment'   => trans('global.status-label.pending_payment'),
            'paid'              => trans('global.status-label.paid'),
            'canceled'          => trans('global.status-label.canceled'),
            'cancelled'         => trans('global.status-label.canceled'),
            'finished'          => trans('global.status-label.finish'),
            'back'              => trans('global.status-label.back'),
            'unauthorized'      => trans('global.status-label.unauthorized'),
            'canceled_sri'      => trans('global.status-label.canceled_sri'),

        ];

        ksort($status);

        return $status;
    }
}

if (! function_exists('statusSimple')) {
    /**
     * Get simple statuses
     *
     * @return array
     */
    function statusSimple(): array
    {
        $status = [
            'active'    => trans('global.status-label.active'),
            'inactive'  => trans('global.status-label.inactive'),
            'deleted'   => trans('global.status-label.deleted'),
        ];

        ksort($status);

        return $status;
    }
}

if (! function_exists('statusUsers')) {
    /**
     * Get simple statuses
     *
     * @return array
     */
    function statusUsers(): array
    {
        $status = [
            'active'    => trans('global.status-label.active'),
            'blocked'   => trans('global.status-label.blocked'),
            'inactive'  => trans('global.status-label.inactive'),
            'deleted'   => trans('global.status-label.deleted'),
            'created'   => trans('global.status-label.created'),
        ];

        ksort($status);

        return $status;
    }
}

if (! function_exists('statusMetrics')) {
    /**
     * Get simple statuses
     *
     * @return array
     */
    function statusMetrics(): array
    {
        $status = [
            'activated'     => trans('global.status-label.active'),
            'blocked'       => trans('global.status-label.blocked'),
            'inactivated'   => trans('global.status-label.inactive'),
            'deleted'       => trans('global.status-label.deleted'),
            'created'       => trans('global.status-label.created'),
            'updated'       => trans('global.status-label.updated'),
        ];

        ksort($status);

        return $status;
    }
}

if (! function_exists('statusPlans')) {
    /**
     * Get plan statuses
     *
     * @return array
     */
    function statusPlans(): array
    {
        $status = [
            1 => trans('global.status-label.active'),
            0 => trans('global.status-label.inactive'),
        ];

        ksort($status);

        return $status;
    }
}

if (! function_exists('statusBoolean')) {
    /**
     * Get cut-off statuses
     *
     * @return array
     */
    function statusBoolean(): array
    {
        $status = [
            1 => trans('global.yes'),
            0 => trans('global.no'),
        ];

        ksort($status);

        return $status;
    }
}

if (! function_exists('isAdmin')) {
    /**
     * Get cut-off statuses
     *
     * @return array
     */
    function isAdmin(): array
    {
        $status = [
            1 => trans('global.backend'),
            0 => trans('global.frontend'),
        ];

        ksort($status);

        return $status;
    }
}

if (! function_exists('auditStatuses')) {
    /**
     * Get audit statuses
     *
     * @return array
     */
    function auditStatuses(): array
    {
        $audits = config('audit.events');

        foreach ($audits as $audit) {
            $status [$audit] = trans('global.' . $audit);
        }

        ksort($status);

        return $status;
    }
}


if (! function_exists('invoiceStatus')) {
    /**
     * Get invoice statuses
     *
     * @return string
     */
    function invoiceStatus($response): string
    {
        $status = 'unprocessed';

        switch ($response) {
            case 'NOPROCESADA':
                return 'unprocessed';
            case 'RECIBIDA':
                return 'received';
            case 'DEVUELTA':
                return 'back';
            case 'AUTORIZADA':
                return 'processed';
            case 'NOAUTORIZADA':
                return 'unauthorized';
            case 'ANULADOSRI':
                return 'canceled_sri';
            case 'CANCELADO':
                return 'canceled';
            case 'BATCH':
                return 'unprocessed';
        }
        return $status;
    }
}
