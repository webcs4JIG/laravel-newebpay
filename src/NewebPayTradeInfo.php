<?php

namespace Webcs4JIG\NewebPay;

class NewebPayTradeInfo extends BaseNewebPay
{
    /**
     * The newebpay boot hook.
     *
     * @return void
     */
    public function boot()
    {
        $this->setApiPath('API/QueryTradeInfo');
        $this->setAsyncSender();

        $this->setNotifyURL();
    }

    /**
     * Set Order.
     *
     * @param  string  $no
     * @param  int  $amt
     * @param  string  $desc
     * @param  string  $email
     * @return $this
     */
    public function setOrderInfo($no, $amt)
    {
        $this->TradeData['MerchantOrderNo'] = $no;
        $this->TradeData['Amt'] = $amt;

        return $this;
    }

    /**
     * Get request data.
     *
     * @return array
     */
    public function getRequestData()
    {
        $postData = $this->encryptDataByAES($this->TradeData, $this->HashKey, $this->HashIV);

        return [
            'MerchantID_' => $this->MerchantID,
            'PostData_' => $postData,
        ];
    }
}
