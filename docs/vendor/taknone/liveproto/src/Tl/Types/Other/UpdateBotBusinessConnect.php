<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param botbusinessconnection connection int qts
 * @return Update
 */

final class UpdateBotBusinessConnect extends Instance {
	public function request(object $connection,int $qts) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8ae5c97a);
		$writer->write($connection->read());
		$writer->writeInt($qts);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['connection'] = $reader->tgreadObject();
		$result['qts'] = $reader->readInt();
		return new self($result);
	}
}

?>