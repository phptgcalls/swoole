<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int id storyitem story
 * @return WebPageAttribute
 */

final class WebPageAttributeStory extends Instance {
	public function request(object $peer,int $id,? object $story = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2e94c3e7);
		$flags = 0;
		$flags |= is_null($story) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($id);
		if(is_null($story) === false):
			$writer->write($story->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['peer'] = $reader->tgreadObject();
		$result['id'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['story'] = $reader->tgreadObject();
		else:
			$result['story'] = null;
		endif;
		return new self($result);
	}
}

?>