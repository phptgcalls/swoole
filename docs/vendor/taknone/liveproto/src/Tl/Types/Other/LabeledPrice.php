<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string label long amount
 * @return LabeledPrice
 */

final class LabeledPrice extends Instance {
	public function request(string $label,int $amount) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcb296bf8);
		$writer->tgwriteBytes($label);
		$writer->writeLong($amount);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['label'] = $reader->tgreadBytes();
		$result['amount'] = $reader->readLong();
		return new self($result);
	}
}

?>