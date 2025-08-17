<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id string title true autofill_new_broadcasts true autofill_public_groups true autofill_new_correspondents chatphoto photo
 * @return Folder
 */

final class Folder extends Instance {
	public function request(int $id,string $title,? true $autofill_new_broadcasts = null,? true $autofill_public_groups = null,? true $autofill_new_correspondents = null,? object $photo = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xff544e65);
		$flags = 0;
		$flags |= is_null($autofill_new_broadcasts) ? 0 : (1 << 0);
		$flags |= is_null($autofill_public_groups) ? 0 : (1 << 1);
		$flags |= is_null($autofill_new_correspondents) ? 0 : (1 << 2);
		$flags |= is_null($photo) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->writeInt($id);
		$writer->tgwriteBytes($title);
		if(is_null($photo) === false):
			$writer->write($photo->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['autofill_new_broadcasts'] = true;
		else:
			$result['autofill_new_broadcasts'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['autofill_public_groups'] = true;
		else:
			$result['autofill_public_groups'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['autofill_new_correspondents'] = true;
		else:
			$result['autofill_new_correspondents'] = false;
		endif;
		$result['id'] = $reader->readInt();
		$result['title'] = $reader->tgreadBytes();
		if($flags & (1 << 3)):
			$result['photo'] = $reader->tgreadObject();
		else:
			$result['photo'] = null;
		endif;
		return new self($result);
	}
}

?>