<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long emoji_id Vector<int> background_colors
 * @return VideoSize
 */

final class VideoSizeEmojiMarkup extends Instance {
	public function request(int $emoji_id,array $background_colors) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf85c413c);
		$writer->writeLong($emoji_id);
		$writer->tgwriteVector($background_colors,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['emoji_id'] = $reader->readLong();
		$result['background_colors'] = $reader->tgreadVector('int');
		return new self($result);
	}
}

?>