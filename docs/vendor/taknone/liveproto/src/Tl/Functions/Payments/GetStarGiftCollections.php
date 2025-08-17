<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer long hash
 * @return payments.StarGiftCollections
 */

final class GetStarGiftCollections extends Instance {
	public function request(object $peer,int $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x981b91dd);
		$writer->write($peer->read());
		$writer->writeLong($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>