<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call inputuser user_id true video
 * @return Updates
 */

final class InviteConferenceCallParticipant extends Instance {
	public function request(object $call,object $user_id,? true $video = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbcf22685);
		$flags = 0;
		$flags |= is_null($video) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($call->read());
		$writer->write($user_id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>