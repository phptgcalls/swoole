<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string id string provider_charge_id
 * @return PaymentCharge
 */

final class PaymentCharge extends Instance {
	public function request(string $id,string $provider_charge_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xea02c27e);
		$writer->tgwriteBytes($id);
		$writer->tgwriteBytes($provider_charge_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->tgreadBytes();
		$result['provider_charge_id'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>