<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer Vector<StoryItem> stories int max_read_id
 * @return PeerStories
 */

final class PeerStories extends Instance {
	public function request(object $peer,array $stories,? int $max_read_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9a35e999);
		$flags = 0;
		$flags |= is_null($max_read_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($max_read_id) === false):
			$writer->writeInt($max_read_id);
		endif;
		$writer->tgwriteVector($stories,'StoryItem');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['peer'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['max_read_id'] = $reader->readInt();
		else:
			$result['max_read_id'] = null;
		endif;
		$result['stories'] = $reader->tgreadVector('StoryItem');
		return new self($result);
	}
}

?>