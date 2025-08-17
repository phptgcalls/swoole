<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<int> palette_colors Vector<int> bg_colors Vector<int> story_colors
 * @return help.PeerColorSet
 */

final class PeerColorProfileSet extends Instance {
	public function request(array $palette_colors,array $bg_colors,array $story_colors) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x767d61eb);
		$writer->tgwriteVector($palette_colors,'int');
		$writer->tgwriteVector($bg_colors,'int');
		$writer->tgwriteVector($story_colors,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['palette_colors'] = $reader->tgreadVector('int');
		$result['bg_colors'] = $reader->tgreadVector('int');
		$result['story_colors'] = $reader->tgreadVector('int');
		return new self($result);
	}
}

?>