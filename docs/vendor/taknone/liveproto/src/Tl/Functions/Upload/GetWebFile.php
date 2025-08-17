<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Upload;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputwebfilelocation location int offset int limit
 * @return upload.WebFile
 */

final class GetWebFile extends Instance {
	public function request(object $location,int $offset,int $limit) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x24e6818d);
		$writer->write($location->read());
		$writer->writeInt($offset);
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