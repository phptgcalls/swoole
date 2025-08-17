<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string name string phone string email postaddress shipping_address
 * @return PaymentRequestedInfo
 */

final class PaymentRequestedInfo extends Instance {
	public function request(? string $name = null,? string $phone = null,? string $email = null,? object $shipping_address = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x909c3f94);
		$flags = 0;
		$flags |= is_null($name) ? 0 : (1 << 0);
		$flags |= is_null($phone) ? 0 : (1 << 1);
		$flags |= is_null($email) ? 0 : (1 << 2);
		$flags |= is_null($shipping_address) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		if(is_null($name) === false):
			$writer->tgwriteBytes($name);
		endif;
		if(is_null($phone) === false):
			$writer->tgwriteBytes($phone);
		endif;
		if(is_null($email) === false):
			$writer->tgwriteBytes($email);
		endif;
		if(is_null($shipping_address) === false):
			$writer->write($shipping_address->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['name'] = $reader->tgreadBytes();
		else:
			$result['name'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['phone'] = $reader->tgreadBytes();
		else:
			$result['phone'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['email'] = $reader->tgreadBytes();
		else:
			$result['email'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['shipping_address'] = $reader->tgreadObject();
		else:
			$result['shipping_address'] = null;
		endif;
		return new self($result);
	}
}

?>