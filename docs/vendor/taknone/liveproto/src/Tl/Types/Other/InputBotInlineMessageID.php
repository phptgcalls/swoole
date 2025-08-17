<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int dc_id long id long access_hash
 * @return InputBotInlineMessageID
 */

final class InputBotInlineMessageID extends Instance {
	public function request(int $dc_id,int $id,int $access_hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x890c3d89);
		$writer->writeInt($dc_id);
		$writer->writeLong($id);
		$writer->writeLong($access_hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['dc_id'] = $reader->readInt();
		$result['id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		return new self($result);
	}
}

?>