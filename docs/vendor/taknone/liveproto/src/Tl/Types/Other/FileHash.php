<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long offset int limit bytes hash
 * @return FileHash
 */

final class FileHash extends Instance {
	public function request(int $offset,int $limit,string $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf39b035c);
		$writer->writeLong($offset);
		$writer->writeInt($limit);
		$writer->tgwriteBytes($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['offset'] = $reader->readLong();
		$result['limit'] = $reader->readInt();
		$result['hash'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>