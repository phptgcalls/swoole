<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string state storiesstealthmode stealth_mode
 * @return stories.AllStories
 */

final class AllStoriesNotModified extends Instance {
	public function request(string $state,object $stealth_mode) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1158fe3e);
		$flags = 0;
		$writer->writeInt($flags);
		$writer->tgwriteBytes($state);
		$writer->write($stealth_mode->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['state'] = $reader->tgreadBytes();
		$result['stealth_mode'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>