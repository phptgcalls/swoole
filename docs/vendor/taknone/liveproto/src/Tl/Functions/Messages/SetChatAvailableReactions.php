<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer chatreactions available_reactions int reactions_limit bool paid_enabled
 * @return Updates
 */

final class SetChatAvailableReactions extends Instance {
	public function request(object $peer,object $available_reactions,? int $reactions_limit = null,? bool $paid_enabled = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x864b2581);
		$flags = 0;
		$flags |= is_null($reactions_limit) ? 0 : (1 << 0);
		$flags |= is_null($paid_enabled) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->write($available_reactions->read());
		if(is_null($reactions_limit) === false):
			$writer->writeInt($reactions_limit);
		endif;
		if(is_null($paid_enabled) === false):
			$writer->tgwriteBool($paid_enabled);
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