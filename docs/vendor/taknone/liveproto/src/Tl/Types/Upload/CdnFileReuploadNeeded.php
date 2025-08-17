<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Upload;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes request_token
 * @return upload.CdnFile
 */

final class CdnFileReuploadNeeded extends Instance {
	public function request(string $request_token) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xeea8e46e);
		$writer->tgwriteBytes($request_token);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['request_token'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>