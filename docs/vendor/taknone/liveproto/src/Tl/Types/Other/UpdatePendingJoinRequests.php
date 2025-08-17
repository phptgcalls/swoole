<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int requests_pending Vector<long> recent_requesters
 * @return Update
 */

final class UpdatePendingJoinRequests extends Instance {
	public function request(object $peer,int $requests_pending,array $recent_requesters) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7063c3db);
		$writer->write($peer->read());
		$writer->writeInt($requests_pending);
		$writer->tgwriteVector($recent_requesters,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['requests_pending'] = $reader->readInt();
		$result['recent_requesters'] = $reader->tgreadVector('long');
		return new self($result);
	}
}

?>