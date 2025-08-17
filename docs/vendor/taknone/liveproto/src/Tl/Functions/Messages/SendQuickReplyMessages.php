<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int shortcut_id Vector<int> id Vector<long> random_id
 * @return Updates
 */

final class SendQuickReplyMessages extends Instance {
	public function request(object $peer,int $shortcut_id,array $id,array $random_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6c750de1);
		$writer->write($peer->read());
		$writer->writeInt($shortcut_id);
		$writer->tgwriteVector($id,'int');
		$writer->tgwriteVector($random_id,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>