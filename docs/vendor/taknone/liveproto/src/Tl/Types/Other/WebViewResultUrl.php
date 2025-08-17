<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url true fullsize true fullscreen long query_id
 * @return WebViewResult
 */

final class WebViewResultUrl extends Instance {
	public function request(string $url,? true $fullsize = null,? true $fullscreen = null,? int $query_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4d22ff98);
		$flags = 0;
		$flags |= is_null($fullsize) ? 0 : (1 << 1);
		$flags |= is_null($fullscreen) ? 0 : (1 << 2);
		$flags |= is_null($query_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($query_id) === false):
			$writer->writeLong($query_id);
		endif;
		$writer->tgwriteBytes($url);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['fullsize'] = true;
		else:
			$result['fullsize'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['fullscreen'] = true;
		else:
			$result['fullscreen'] = false;
		endif;
		if($flags & (1 << 0)):
			$result['query_id'] = $reader->readLong();
		else:
			$result['query_id'] = null;
		endif;
		$result['url'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>