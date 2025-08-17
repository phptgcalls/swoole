<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url true force_large_media true force_small_media true optional
 * @return InputMedia
 */

final class InputMediaWebPage extends Instance {
	public function request(string $url,? true $force_large_media = null,? true $force_small_media = null,? true $optional = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc21b8849);
		$flags = 0;
		$flags |= is_null($force_large_media) ? 0 : (1 << 0);
		$flags |= is_null($force_small_media) ? 0 : (1 << 1);
		$flags |= is_null($optional) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($url);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['force_large_media'] = true;
		else:
			$result['force_large_media'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['force_small_media'] = true;
		else:
			$result['force_small_media'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['optional'] = true;
		else:
			$result['optional'] = false;
		endif;
		$result['url'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>