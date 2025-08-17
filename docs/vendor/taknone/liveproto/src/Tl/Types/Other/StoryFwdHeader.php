<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true modified peer from string from_name int story_id
 * @return StoryFwdHeader
 */

final class StoryFwdHeader extends Instance {
	public function request(? true $modified = null,? object $from = null,? string $from_name = null,? int $story_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb826e150);
		$flags = 0;
		$flags |= is_null($modified) ? 0 : (1 << 3);
		$flags |= is_null($from) ? 0 : (1 << 0);
		$flags |= is_null($from_name) ? 0 : (1 << 1);
		$flags |= is_null($story_id) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($from) === false):
			$writer->write($from->read());
		endif;
		if(is_null($from_name) === false):
			$writer->tgwriteBytes($from_name);
		endif;
		if(is_null($story_id) === false):
			$writer->writeInt($story_id);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 3)):
			$result['modified'] = true;
		else:
			$result['modified'] = false;
		endif;
		if($flags & (1 << 0)):
			$result['from'] = $reader->tgreadObject();
		else:
			$result['from'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['from_name'] = $reader->tgreadBytes();
		else:
			$result['from_name'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['story_id'] = $reader->readInt();
		else:
			$result['story_id'] = null;
		endif;
		return new self($result);
	}
}

?>