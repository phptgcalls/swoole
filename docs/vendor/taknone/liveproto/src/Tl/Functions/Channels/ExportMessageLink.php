<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel int id true grouped true thread
 * @return ExportedMessageLink
 */

final class ExportMessageLink extends Instance {
	public function request(object $channel,int $id,? true $grouped = null,? true $thread = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe63fadeb);
		$flags = 0;
		$flags |= is_null($grouped) ? 0 : (1 << 0);
		$flags |= is_null($thread) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($channel->read());
		$writer->writeInt($id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>