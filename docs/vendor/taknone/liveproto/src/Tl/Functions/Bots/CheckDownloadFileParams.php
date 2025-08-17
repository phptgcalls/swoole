<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser bot string file_name string url
 * @return Bool
 */

final class CheckDownloadFileParams extends Instance {
	public function request(object $bot,string $file_name,string $url) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x50077589);
		$writer->write($bot->read());
		$writer->tgwriteBytes($file_name);
		$writer->tgwriteBytes($url);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>