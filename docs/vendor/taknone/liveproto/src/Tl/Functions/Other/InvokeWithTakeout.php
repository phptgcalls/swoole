<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long takeout_id x query
 * @return X
 */

final class InvokeWithTakeout extends Instance {
	public function request(int $takeout_id,object $query) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xaca9fd2e);
		$writer->writeLong($takeout_id);
		$writer->write($query->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>