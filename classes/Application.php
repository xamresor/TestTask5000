<?php

class Application
{
    private static $table = 'applications';

    public static function getById($id) :array {
        return DataBase::getById(self::$table, $id);
    }

    public static function register(string $email, int $amount) :bool {
        $result = DataBase::addRecord(self::$table, [
            'email' => $email,
            'amount' => $amount,
        ]);

        if ($result) {
            Deal::createApplicationDeal($result);
        }
        return $result;
    }

    public static function getApplicationDataList() :array {
        $temp = [];
        $applications = DataBase::getAll(self::$table);

        foreach($applications as $application) {
            $partner = Partner::getOfferData($application['id']);
            $temp[] = [
                'id' => $application['id'],
                'email' => $application['email'],
                'amount' => $application['amount'],
                'partnerId' => $partner['id'],
                'partnerName' => $partner['name'],
                'partnerSendAt' => $partner['send_at'],
                'offerStatus' => $partner['offer_status'],
            ];
        }
        return $temp;
    }

    public static function makeOffer(int $id) :bool {
        $dealData = Deal::getByApplicationId($id);
        if (!empty($dealData['created_at']) &&
            empty($dealData['offered_at'])) {
            if (Deal::makeOffer($id, $dealData['partner_id'])) {
                return true;
            }
        }
        return false;
    }

    public static function sendOfferEmail(int $id) :bool {
        $data = self::getById($id);
        Emailer::sendEmail($data['email'], 'Offer', 'Message');
        return false;
    }
}
