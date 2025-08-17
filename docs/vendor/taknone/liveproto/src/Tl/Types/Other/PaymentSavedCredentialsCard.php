<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string id string title
 * @return PaymentSavedCredentials
 */

final class PaymentSavedCredentialsCard extends Instance {
	public function request(string $id,string $title) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcdc27a1f);
		$writer->tgwriteBytes($id);
		$writer->tgwriteBytes($title);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->tgreadBytes();
		$result['title'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>