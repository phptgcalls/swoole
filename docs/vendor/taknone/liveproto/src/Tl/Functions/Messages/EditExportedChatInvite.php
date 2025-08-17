<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer string link true revoked int expire_date int usage_limit bool request_needed string title
 * @return messages.ExportedChatInvite
 */

final class EditExportedChatInvite extends Instance {
	public function request(object $peer,string $link,? true $revoked = null,? int $expire_date = null,? int $usage_limit = null,? bool $request_needed = null,? string $title = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbdca2f75);
		$flags = 0;
		$flags |= is_null($revoked) ? 0 : (1 << 2);
		$flags |= is_null($expire_date) ? 0 : (1 << 0);
		$flags |= is_null($usage_limit) ? 0 : (1 << 1);
		$flags |= is_null($request_needed) ? 0 : (1 << 3);
		$flags |= is_null($title) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->tgwriteBytes($link);
		if(is_null($expire_date) === false):
			$writer->writeInt($expire_date);
		endif;
		if(is_null($usage_limit) === false):
			$writer->writeInt($usage_limit);
		endif;
		if(is_null($request_needed) === false):
			$writer->tgwriteBool($request_needed);
		endif;
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
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