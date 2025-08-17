<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer inputuser admin_id int limit true revoked int offset_date string offset_link
 * @return messages.ExportedChatInvites
 */

final class GetExportedChatInvites extends Instance {
	public function request(object $peer,object $admin_id,int $limit,? true $revoked = null,? int $offset_date = null,? string $offset_link = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa2b5a3f6);
		$flags = 0;
		$flags |= is_null($revoked) ? 0 : (1 << 3);
		$flags |= is_null($offset_date) ? 0 : (1 << 2);
		$flags |= is_null($offset_link) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->write($admin_id->read());
		if(is_null($offset_date) === false):
			$writer->writeInt($offset_date);
		endif;
		if(is_null($offset_link) === false):
			$writer->tgwriteBytes($offset_link);
		endif;
		$writer->writeInt($limit);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>