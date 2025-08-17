<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel true signatures_enabled true profiles_enabled
 * @return Updates
 */

final class ToggleSignatures extends Instance {
	public function request(object $channel,? true $signatures_enabled = null,? true $profiles_enabled = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x418d549c);
		$flags = 0;
		$flags |= is_null($signatures_enabled) ? 0 : (1 << 0);
		$flags |= is_null($profiles_enabled) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($channel->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>