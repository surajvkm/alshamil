<?xml version='1.0' encoding='UTF-8'?><wsdl:definitions xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/" xmlns:tns="http://uilogic.dp.toml.com/" xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/" xmlns:ns1="http://schemas.xmlsoap.org/soap/http" name="InvokePMTBitMapService" targetNamespace="http://uilogic.dp.toml.com/">
  <wsdl:types>
<xs:schema xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:tns="http://uilogic.dp.toml.com/" elementFormDefault="unqualified" targetNamespace="http://uilogic.dp.toml.com/" version="1.0">

  <xs:element name="invokeQueryAPI" type="tns:invokeQueryAPI" />

  <xs:element name="invokeQueryAPIResponse" type="tns:invokeQueryAPIResponse" />

  <xs:element name="invokeRefundAPI" type="tns:invokeRefundAPI" />

  <xs:element name="invokeRefundAPIResponse" type="tns:invokeRefundAPIResponse" />

  <xs:element name="invokeSettlementAPI" type="tns:invokeSettlementAPI" />

  <xs:element name="invokeSettlementAPIResponse" type="tns:invokeSettlementAPIResponse" />

  <xs:complexType name="invokeRefundAPI">
    <xs:sequence>
      <xs:element minOccurs="0" name="requestparameters" type="xs:string" />
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="invokeRefundAPIResponse">
    <xs:sequence>
      <xs:element minOccurs="0" name="return" type="xs:string" />
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="invokeQueryAPI">
    <xs:sequence>
      <xs:element minOccurs="0" name="requestparameters" type="xs:string" />
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="invokeQueryAPIResponse">
    <xs:sequence>
      <xs:element minOccurs="0" name="return" type="xs:string" />
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="invokeSettlementAPI">
    <xs:sequence>
      <xs:element minOccurs="0" name="requestparameters" type="xs:string" />
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="invokeSettlementAPIResponse">
    <xs:sequence>
      <xs:element minOccurs="0" name="return" type="xs:string" />
    </xs:sequence>
  </xs:complexType>

</xs:schema>
  </wsdl:types>
  <wsdl:message name="invokeSettlementAPIResponse">
    <wsdl:part element="tns:invokeSettlementAPIResponse" name="parameters">
    </wsdl:part>
  </wsdl:message>
  <wsdl:message name="invokeQueryAPIResponse">
    <wsdl:part element="tns:invokeQueryAPIResponse" name="parameters">
    </wsdl:part>
  </wsdl:message>
  <wsdl:message name="invokeRefundAPIResponse">
    <wsdl:part element="tns:invokeRefundAPIResponse" name="parameters">
    </wsdl:part>
  </wsdl:message>
  <wsdl:message name="invokeRefundAPI">
    <wsdl:part element="tns:invokeRefundAPI" name="parameters">
    </wsdl:part>
  </wsdl:message>
  <wsdl:message name="invokeQueryAPI">
    <wsdl:part element="tns:invokeQueryAPI" name="parameters">
    </wsdl:part>
  </wsdl:message>
  <wsdl:message name="invokeSettlementAPI">
    <wsdl:part element="tns:invokeSettlementAPI" name="parameters">
    </wsdl:part>
  </wsdl:message>
  <wsdl:portType name="InvokePMTBitMapWebService">
    <wsdl:operation name="invokeRefundAPI">
      <wsdl:input message="tns:invokeRefundAPI" name="invokeRefundAPI">
    </wsdl:input>
      <wsdl:output message="tns:invokeRefundAPIResponse" name="invokeRefundAPIResponse">
    </wsdl:output>
    </wsdl:operation>
    <wsdl:operation name="invokeQueryAPI">
      <wsdl:input message="tns:invokeQueryAPI" name="invokeQueryAPI">
    </wsdl:input>
      <wsdl:output message="tns:invokeQueryAPIResponse" name="invokeQueryAPIResponse">
    </wsdl:output>
    </wsdl:operation>
    <wsdl:operation name="invokeSettlementAPI">
      <wsdl:input message="tns:invokeSettlementAPI" name="invokeSettlementAPI">
    </wsdl:input>
      <wsdl:output message="tns:invokeSettlementAPIResponse" name="invokeSettlementAPIResponse">
    </wsdl:output>
    </wsdl:operation>
  </wsdl:portType>
  <wsdl:binding name="InvokePMTBitMapServiceSoapBinding" type="tns:InvokePMTBitMapWebService">
    <soap:binding style="document" transport="http://schemas.xmlsoap.org/soap/http" />
    <wsdl:operation name="invokeQueryAPI">
      <soap:operation soapAction="" style="document" />
      <wsdl:input name="invokeQueryAPI">
        <soap:body use="literal" />
      </wsdl:input>
      <wsdl:output name="invokeQueryAPIResponse">
        <soap:body use="literal" />
      </wsdl:output>
    </wsdl:operation>
    <wsdl:operation name="invokeRefundAPI">
      <soap:operation soapAction="" style="document" />
      <wsdl:input name="invokeRefundAPI">
        <soap:body use="literal" />
      </wsdl:input>
      <wsdl:output name="invokeRefundAPIResponse">
        <soap:body use="literal" />
      </wsdl:output>
    </wsdl:operation>
    <wsdl:operation name="invokeSettlementAPI">
      <soap:operation soapAction="" style="document" />
      <wsdl:input name="invokeSettlementAPI">
        <soap:body use="literal" />
      </wsdl:input>
      <wsdl:output name="invokeSettlementAPIResponse">
        <soap:body use="literal" />
      </wsdl:output>
    </wsdl:operation>
  </wsdl:binding>
  <wsdl:service name="InvokePMTBitMapService">
    <wsdl:port binding="tns:InvokePMTBitMapServiceSoapBinding" name="InvokePMTBitMapWebServicePort">
      <soap:address location="https://neo.network.ae/direcpay/secure/InvokePMTBitMapWebService" />
    </wsdl:port>
  </wsdl:service>
</wsdl:definitions>