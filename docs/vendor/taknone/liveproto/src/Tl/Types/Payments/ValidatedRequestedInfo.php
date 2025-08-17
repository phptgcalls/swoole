<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string id Vector<ShippingOption> shipping_options
 * @return payments.ValidatedRequestedInfo
 */

final class ValidatedRequestedInfo extends Instance {
	public function request(? string $id = null,? array $shipping_options = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd1451883);
		$flags = 0;
		$flags |= is_null($id) ? 0 : (1 << 0);
		$flags |= is_null($shipping_options) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($id) === false):
			$writer->tgwriteBytes($id);
		endif;
		if(is_null($shipping_options) === false):
			$writer->tgwriteVector($shipping_options,'ShippingOption');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['id'] = $reader->tgreadBytes();
		else:
			$result['id'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['shipping_options'] = $reader->tgreadVector('ShippingOption');
		else:
			$result['shipping_options'] = null;
		endif;
		return new self($result);
	}
}

?>