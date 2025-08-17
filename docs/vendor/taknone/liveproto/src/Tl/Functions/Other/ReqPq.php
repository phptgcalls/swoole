<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int128 nonce
 * @return ResPQ
 */

final class ReqPq extends Instance {
	public function request(int | string $nonce) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x60469778);
		$writer->writeLargeInt($nonce,128);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>