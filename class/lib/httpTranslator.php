<?php
/*
 * Class:HTTPTranslator
*
* Processing the translator request.
*/
Class httpTranslator
{
    /*
     * Create and execute the HTTP CURL request.
    *
    * @param string $url        HTTP Url.
    * @param string $authHeader Authorization Header string.
    * @param string $postData   Data to post.
    *
    * @return string.
    *
    */
    public function curlRequest($url, $authHeader, $postData='')
    {
        //Initialize the Curl Session.
        $ch = curl_init();
        //Set the Curl url.
        curl_setopt ($ch, CURLOPT_URL, $url);
        //Set the HTTP HEADER Fields.
        curl_setopt ($ch, CURLOPT_HTTPHEADER, array($authHeader,"Content-Type: text/xml"));
        //CURLOPT_RETURNTRANSFER- TRUE to return the transfer as a string of the return value of curl_exec().
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //CURLOPT_SSL_VERIFYPEER- Set FALSE to stop cURL from verifying the peer's certificate.
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, False);
        if($postData)
        {
            //Set HTTP POST Request.
            curl_setopt($ch, CURLOPT_POST, TRUE);
            //Set data to POST in HTTP "POST" Operation.
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }
        //Execute the  cURL session.
        $curlResponse = curl_exec($ch);
        //Get the Error Code returned by Curl.
        $curlErrno = curl_errno($ch);
        if ($curlErrno)
        {
            $curlError = curl_error($ch);
            throw new Exception($curlError);
        }
        //Close a cURL session.
        curl_close($ch);
        return $curlResponse;
    }

    /*
     * Create Request XML Format.
    *
    * @param string $languageCode  Language code
    *
    * @return string.
    */
    public function createReqXML($languageCodes)
    {
        //Create the XML string for passing the values.
        $requestXml = '<ArrayOfstring xmlns="http://schemas.microsoft.com/2003/10/Serialization/Arrays" xmlns:i="http://www.w3.org/2001/XMLSchema-instance">';
        if(sizeof($languageCodes) > 0)
        {
            foreach($languageCodes as $codes)
            {
                $requestXml .= "<string>$codes</string>";
            }
        }
        else
        {
            throw new Exception('$languageCodes array is empty.');
        }

        $requestXml .= '</ArrayOfstring>';
        return $requestXml;
    }
}