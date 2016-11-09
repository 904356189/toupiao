<?php

class DeliveryAddressInfo {
	var $address;

	var $mobilePhone;

	var $name;

	var $telPhone;

	var $zipCode;
	
	function getAddress() {
		return $this->address;
	}

	function setAddress($address) {
		$this->address = $address;
	}

	function getMobilePhone() {
		return $this->mobilePhone;
	}

	function setMobilePhone($mobilePhone) {
		$this->mobilePhone = $mobilePhone;
	}

	function getName() {
		return $this->name;
	}

	function setName($name) {
		$this->name = $name;
	}

	function getTelPhone() {
		return $this->telPhone;
	}

	function setTelPhone($telPhone) {
		$this->telPhone = $telPhone;
	}

	function getZipCode() {
		return $this->zipCode;
	}

	function setZipCode($zipCode) {
		$this->zipCode = $zipCode;
	}
}
?>