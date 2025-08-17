<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Upload;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputfilelocation location long offset int limit true precise true cdn_supported
 * @return upload.File
 */

final class GetFile extends Instance {
	public function request(object $location,int $offset,int $limit,? true $precise = null,? true $cdn_supported = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbe5335be);
		$flags = 0;
		$flags |= is_null($precise) ? 0 : (1 << 0);
		$flags |= is_null($cdn_supported) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($location->read());
		$writer->writeLong($offset);
		$writer->writeInt($limit);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>