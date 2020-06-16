<?php

class Deal
{
    private static $table = 'deals';

    private static $statuses = [
        'empty' => 'asked',
        'filled' => 'offered',
    ];

    public static function getByApplicationId(int $applicationId) {
        if ($applicationId) {
            $table = self::$table;
            $query = "SELECT * FROM {$table} WHERE application_id = {$applicationId} ORDER BY created_at DESC LIMIT 1";
            $data = DataBase::getRecord($query);
            $data['status'] = self::getOfferStatusFromData($data);

            return $data;
        }
    }

    public static function getOfferStatusFromData(array $data) {
        if (key_exists('offered_at', $data)) {
            return empty($data['offered_at']) ?
                self::$statuses['empty'] :
                self::$statuses['filled'];
        }
        return false;
    }

    public static function createApplicationDeal(int $applicationId) :int {
        $application = Application::getById($applicationId);
        $partnerId = Partner::selectPartnerByAmount($application['amount']);

        Partner::sendApplicationEmail($applicationId, $partnerId);

        if ($partnerId) {
            return self::createDeal($applicationId, $partnerId);
        }
        return 0;
    }

    public static function createDeal(int $applicationId, int $partnerId) :int {
        return DataBase::addRecord(self::$table, [
            'application_id' => $applicationId,
            'partner_id' => $partnerId,
        ]);
    }

    public static function makeOffer(int $applicationId, int $partnerId) :bool {
        Application::sendOfferEmail($applicationId);

        $table = self::$table;
        $result = DataBase::quary("
            UPDATE {$table}
            SET offered_at = now()
            WHERE application_id = {$applicationId} AND partner_id = {$partnerId}
        ");
        return (bool) $result;
    }
}
