<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string q int top_msg_id
 * @return ChannelParticipantsFilter
 */

final class ChannelParticipantsMentions extends Instance {
	public function request(? string $q = null,? int $top_msg_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe04b5ceb);
		$flags = 0;
		$flags |= is_null($q) ? 0 : (1 << 0);
		$flags |= is_null($top_msg_id) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($q) === false):
			$writer->tgwriteBytes($q);
		endif;
		if(is_null($top_msg_id) === false):
			$writer->writeInt($top_msg_id);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['q'] = $reader->tgreadBytes();
		else:
			$result['q'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['top_msg_id'] = $reader->readInt();
		else:
			$result['top_msg_id'] = null;
		endif;
		return new self($result);
	}
}

?>