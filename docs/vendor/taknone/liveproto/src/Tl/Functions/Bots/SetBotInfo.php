<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string lang_code inputuser bot string name string about string description
 * @return Bool
 */

final class SetBotInfo extends Instance {
	public function request(string $lang_code,? object $bot = null,? string $name = null,? string $about = null,? string $description = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x10cf3123);
		$flags = 0;
		$flags |= is_null($bot) ? 0 : (1 << 2);
		$flags |= is_null($name) ? 0 : (1 << 3);
		$flags |= is_null($about) ? 0 : (1 << 0);
		$flags |= is_null($description) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($bot) === false):
			$writer->write($bot->read());
		endif;
		$writer->tgwriteBytes($lang_code);
		if(is_null($name) === false):
			$writer->tgwriteBytes($name);
		endif;
		if(is_null($about) === false):
			$writer->tgwriteBytes($about);
		endif;
		if(is_null($description) === false):
			$writer->tgwriteBytes($description);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>