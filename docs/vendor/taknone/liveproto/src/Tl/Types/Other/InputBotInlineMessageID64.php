<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int dc_id long owner_id int id long access_hash
 * @return InputBotInlineMessageID
 */

final class InputBotInlineMessageID64 extends Instance {
	public function request(int $dc_id,int $owner_id,int $id,int $access_hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb6d915d7);
		$writer->writeInt($dc_id);
		$writer->writeLong($owner_id);
		$writer->writeInt($id);
		$writer->writeLong($access_hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['dc_id'] = $reader->readInt();
		$result['owner_id'] = $reader->readLong();
		$result['id'] = $reader->readInt();
		$result['access_hash'] = $reader->readLong();
		return new self($result);
	}
}

?>