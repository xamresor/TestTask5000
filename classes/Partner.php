<?php

class Partner
{
    private static $table = 'partners';
    private static $fields = ['id','name','amount_from','amount_to','send_at'];

    public static function selectPartnerByAmount(int $amount) {
        $partners = DataBase::getAll(self::$table);

        foreach ($partners as $partner) {
            $from = $partner['amount_from'] ?? null;
            $to = $partner['amount_to'] ?? null;

            if (is_null($from) && is_null($to)) {
                continue;
            }

            if ((is_null($from) &&  $amount < $to) ||
                (is_null($to) && $amount >= $from) ||
                ($amount >= $from && $amount < $to)) {
                return $partner['id'];
            }
        }
        return null;
    }

    public static function getOfferData(int $applicationId) {
        $deal = Deal::getByApplicationId($applicationId);
        if ($deal && $deal['partner_id']) {
            $data = DataBase::getById(self::$table, $deal['partner_id']);
            if ($data) {
                $data['send_at'] = $deal['created_at'];
                $data['offer_status'] = $deal['status'];
                return $data;
            }
        }
        return array_flip(self::$fields);
    }

    public static function sendApplicationEmail(int $application_id, int $id) :bool {
        $subject = 'Application ' . $application_id;
        $data = DataBase::getById(self::$table, $id);
        Emailer::sendEmail($data['email'], $subject, 'Message');
        return false;
    }
}
