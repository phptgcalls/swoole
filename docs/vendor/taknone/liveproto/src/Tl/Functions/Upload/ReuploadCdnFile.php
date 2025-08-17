<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Upload;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes file_token bytes request_token
 * @return Vector<FileHash>
 */

final class ReuploadCdnFile extends Instance {
	public function request(string $file_token,string $request_token) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9b2754a8);
		$writer->tgwriteBytes($file_token);
		$writer->tgwriteBytes($request_token);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>